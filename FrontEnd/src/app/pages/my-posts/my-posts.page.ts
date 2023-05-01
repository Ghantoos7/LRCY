import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, ModalController } from '@ionic/angular';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { PopoverController } from '@ionic/angular';
import { ActionSheetController } from '@ionic/angular';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';
import { PostService } from 'src/app/services/post.service';
import { SharedService } from 'src/app/services/shared.service';
import { ReactiveFormsModule } from '@angular/forms';
import { CommentsModalPage } from '../comments-modal/comments-modal.page';

@Component({
  selector: 'app-my-posts',
  templateUrl: './my-posts.page.html',
  styleUrls: ['./my-posts.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule,ReactiveFormsModule]
})
export class MyPostsPage implements OnInit {

  selectedUser: any;

  user_id: string= '';

  othersPage: boolean = false;

  username: string='';
  user_profile_pic: string='';
  full_name: string='';

  posts: any  = [];
  posts_array: any = [];
  isLikedUser: {[key: number]: boolean} = {};
  post_id: number=0;
  isLiked: { [key: number]: { commentId: number, isLiked: boolean }[] } = {};
  comment_contents: any = [];
  likeCount: { [key: number]: number } = {};
  commentCount: { [key: number]: number } = {};

  errorMessage: string = '';
  constructor(private post_service:PostService, private router: Router, private alertController: AlertController, private actionSheetController: ActionSheetController, private service: UserService, private sharedService:SharedService, private modalController:ModalController) { }

  ngOnInit() {

    this.selectedUser = this.sharedService.getSelectedUser();
    this.user_id = this.selectedUser['id'];
    if (!this.user_id) {
      // If user ID is not passed through URL, use logged-in user's ID and info
      this.user_id = localStorage.getItem('user_id') as string;
      this.username = localStorage.getItem('username') as string;
      this.user_profile_pic = localStorage.getItem('user_profile_pic') as string;
      this.full_name = localStorage.getItem('full_name') as string;
    }
    else{
      this.user_id = this.selectedUser['id'];
      this.username = this.selectedUser['username'];
      this.user_profile_pic = this.selectedUser['user_profile_pic'];
      this.full_name = this.selectedUser['name'];
      this.othersPage = true;
    }

    this.router.events.subscribe((event: any) => {
      if (event instanceof NavigationEnd) {
        this.fetchData();
      }
    });

  }

  fetchData() {

    this.service.getOwnPosts(this.user_id).subscribe(response => {
      if (response && response.hasOwnProperty('posts')) {
        this.posts = response;
        this.posts_array = Array.from(this.posts['posts']);
        for (let i = 0; i < this.posts_array.length; i++) {
          const postId = this.posts_array[i].id;
          this.isLikedUser[postId] = localStorage.getItem(`user_${this.user_id}_post_${postId}`) === 'true'; // retrieve the like state from Local Storage
          this.likeCount[postId] = this.posts_array[i].like_count;
          this.commentCount[postId] = this.posts_array[i].comment_count; // Update the comment count from the API response

        }
      } else {
        this.posts_array = [];
      }
  
      // check if there are no posts
      if (this.posts_array.length === 0) {
        this.errorMessage = "No posts found";
      }
    });
  }

  getDaysAgo(postDate: string): string {
    const today = new Date();
    const post = new Date(postDate);
    let yearDiff = today.getFullYear() - post.getFullYear();
    let monthDiff = today.getMonth() - post.getMonth();
    let dayDiff = today.getDate() - post.getDate();
  
    if (dayDiff < 0) {
      monthDiff -= 1;
      const daysInPreviousMonth = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
      dayDiff += daysInPreviousMonth;
    }
  
    if (monthDiff < 0) {
      yearDiff -= 1;
      monthDiff += 12;
    }
  
    if (yearDiff > 0) {
      return `${yearDiff}y ago`;
    } else if (monthDiff > 0) {
      return `${monthDiff}mo ago`;
    } else if (dayDiff > 0) {
      return `${dayDiff}d ago`;
    } else {
      const hourDiff = today.getHours() - post.getHours();
      const minuteDiff = today.getMinutes() - post.getMinutes();
      if (hourDiff > 0) {
        return `${hourDiff}h ago`;
      } else if (minuteDiff > 0) {
        return `${minuteDiff}m ago`;
      } else {
        return `just now`;
      }
    }
  }

  async showActionSheet(i: number) {
    const actionSheet = await this.actionSheetController.create({
      header: 'Options',
      buttons: [
        {
          text: 'Edit',
          icon: 'create-outline',
          handler: () => {
            this.router.navigate(["/edit-post"], {state: { p_id :i }});
          }
        },
        {
          text: 'Delete',
          icon: 'trash-outline',
          handler: async () => {
            const confirm = await this.alertController.create({
              header: 'Confirm',
              message: 'Are you sure you want to delete this post?',
              buttons: [
                {
                  text: 'Cancel',
                  role: 'cancel'
                },
                {
                  text: 'Delete',
                  handler: () => {
                    this.post_service.deletePost(i).subscribe((data: any) => {
                      const parsedResponse = JSON.parse(JSON.stringify(data));
                      const status = parsedResponse.status;
                      if(status == "success"){
                        this.alertController.create({
                          header: 'Your post has been deleted!',
                          message: status,
                          buttons: ['OK']
                        }).then((alert) => alert.present())
                        .catch((err) => console.log(err));
                      this.fetchData(); // Update the posts list instead of reloading the page
                      }
                    });
                  }
                }
              ]
            });
            await confirm.present();
          }
        },
        {
          text: 'Cancel',
          icon: 'close',
          role: 'cancel',
          handler: () => {
          }
        }
      ]
    });
    await actionSheet.present();
}

public animateLikeButton(postId: number) {
  const likeButton = document.getElementById(`like-button-${postId}`);
  likeButton?.classList.add('like-animation');

  likeButton?.addEventListener('animationend', () => {
    likeButton.classList.remove('like-animation');
  });
}



toggleLike(post_id: number) {
  if (this.isLikedUser[post_id]) {
    this.unlikePost(post_id);
  } else {
    this.likePost(post_id);
  }
    this.animateLikeButton(post_id);
}

  likePost(post_id: number) {
    this.post_service.likePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`user_${this.user_id}_post_${post_id}`, 'true'); // store the like state in Local Storage
      this.isLikedUser[post_id] = true;
      this.likeCount[post_id]++;
    });
   
  }
  
  unlikePost(post_id: number) {
    this.post_service.unlikePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`user_${this.user_id}_post_${post_id}`, 'false'); // store the like state in Local Storage
      this.isLikedUser[post_id] = false;
      this.likeCount[post_id]--;
    });
   
  }

  fetchComments(post_id: number) {
    this.post_service.getComments(post_id).subscribe((response : any) => {
      if (response && response.hasOwnProperty('comments')) {
        // Assuming the response object has a 'comments' property containing the list of comments for the post
        this.comment_contents[post_id] = response['comments'];
        this.comment_contents[post_id] = [];
      }
    });
  }

  

  async openCommentsModal(post_id: number) {
    const modal = await this.modalController.create({
      component: CommentsModalPage,
      componentProps: {
        post_id: post_id
      }
    });
    return await modal.present();
  }


  
  async sendComment(p_id: number, i: number) {
    this.post_service.commentPost(p_id, this.user_id, this.comment_contents[i]).subscribe(response => {
      const str = JSON.stringify(response);
      const result = JSON.parse(str);
      const status = result['status'];
      if (status == "success") {
        this.alertController.create({
          message: 'Your comment was added!',
          buttons: ['OK']
        }).then(alert => alert.present());
        this.commentCount[p_id]++;
        this.comment_contents[i] = ''; // Clear the input field after successful submission
      } else if (status == "error") {
        this.alertController.create({
          message: 'Something went wrong.',
          buttons: ['OK']
        }).then(alert => alert.present());
      }
    });

  }
}