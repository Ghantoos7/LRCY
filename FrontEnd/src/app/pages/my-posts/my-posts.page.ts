import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { PopoverController } from '@ionic/angular';
import { ActionSheetController } from '@ionic/angular';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';
import { PostService } from 'src/app/services/post.service';
import { SharedService } from 'src/app/services/shared.service';

@Component({
  selector: 'app-my-posts',
  templateUrl: './my-posts.page.html',
  styleUrls: ['./my-posts.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
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

  constructor(private post_service:PostService, private router: Router, private alertController: AlertController, private actionSheetController: ActionSheetController, private service: UserService, private sharedService:SharedService) { }

  ngOnInit() {

    this.selectedUser = this.sharedService.getSelectedUser();
    this.user_id = this.selectedUser['id'];
    if (!this.user_id) {
      // If user ID is not passed through URL, use logged-in user's ID and info
      this.user_id = localStorage.getItem('userId') as string;
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

    this.service.getOwnPosts(this.user_id).subscribe(response => {
      this.posts = response;
      this.posts_array = Array.from(this.posts['posts']);
      for (let i = 0; i < this.posts_array.length; i++) {
        const postId = this.posts_array[i].id;
        this.isLikedUser[postId] = localStorage.getItem(`user_${this.user_id}_post_${postId}`) === 'true'; // retrieve the like state from Local Storage
        this.likeCount[postId] = this.posts_array[i].like_count;
      }
    });


  }

  getDaysAgo(postDate: string) {
    const today = new Date();
    const post = new Date(postDate);
    const timeDiff = Math.abs(today.getTime() - post.getTime());
    const minutesDiff = Math.floor(timeDiff / (1000 * 60));
    if (minutesDiff < 60) {
      return `${minutesDiff}m ago`;
    }
    const hoursDiff = Math.floor(timeDiff / (1000 * 3600));
    if (hoursDiff < 24) {
      return `${hoursDiff}h ago`;
    }
    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
    return `${daysDiff}d ago`;
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
                      window.location.reload();
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


  toggleLike(post_id: number) {
    if (this.isLikedUser[post_id]) {
    this.unlikePost(post_id);
    } else {
    this.likePost(post_id);
    }
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



  goToComments(post_id: string){
    this.router.navigate(["/comments"], {state: { p_id : post_id }});
    setTimeout(() => {
      
      window.location.reload();

    }, 50);
  }


  async sendComment(p_id: number, i: number){
    this.post_service.commentPost(p_id, this.user_id, this.comment_contents[i]).subscribe(response=>{
      const str = JSON.stringify(response);
      const result = JSON.parse(str);
      const status = result['status'];
       if(status == "success"){
        this.alertController.create({
          message: 'Your comment was added!',
          buttons: ['OK']
        }).then(alert => alert.present());
        window.location.reload();
      }
    else if (status == "error"){
      this.alertController.create({
        message: 'Something went wrong.',
        buttons: ['OK']
      }).then(alert => alert.present());
      }
    });

  }


}