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

@Component({
  selector: 'app-my-posts',
  templateUrl: './my-posts.page.html',
  styleUrls: ['./my-posts.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})
export class MyPostsPage implements OnInit {

  username = localStorage.getItem('username') as string;
  id = localStorage.getItem('userId') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  full_name = localStorage.getItem('full_name') as string;
  posts: any  = [];
  posts_array: any = [];
  isLiked: {[key: number]: boolean} = {};
  post_id: number=0;

  constructor(private post_service:PostService, private router: Router, private alertController: AlertController, private actionSheetController: ActionSheetController, private service: UserService) { }

  ngOnInit() {
    this.service.getOwnPosts(this.id).subscribe(response => {
      this.posts = response;
      this.posts_array = Array.from(this.posts['posts']);
      for (let i = 0; i < this.posts.length; i++) {
        const postId = this.posts[i].id;
        this.isLiked[postId] = localStorage.getItem(`post_${postId}`) === 'true'; // retrieve the like state from Local Storage
      }
    });
  }

  getDaysAgo(postDate: string) {
    const today = new Date();
    const post = new Date(postDate);
    const timeDiff = Math.abs(today.getTime() - post.getTime());
    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
    return daysDiff;
  }

  async showActionSheet(){
    const actionSheet = await this.actionSheetController.create({
      header: 'Options',
      buttons: [
        {
          text: 'Edit',
          icon: 'create-outline',
          handler: () => {
            // Implement the edit action here
          }
        },
        {
          text: 'Delete',
          icon: 'trash-outline',
          handler: () => {
            // Implement the delete action here
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
    if (this.isLiked[post_id]) {
    this.unlikePost(post_id);
    } else {
    this.likePost(post_id);
    }
  }

  likePost(post_id: number) {
    this.post_service.likePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`post_${post_id}`, 'true'); // store the like state in Local Storage
      this.isLiked[post_id] = true;
    });
  }
  
  unlikePost(post_id: number) {
    this.post_service.unlikePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`post_${post_id}`, 'false'); // store the like state in Local Storage
      this.isLiked[post_id] = false;
    });
  }


  goToComments(){
    this.router.navigate(['/comments']);
  }
  }

 



