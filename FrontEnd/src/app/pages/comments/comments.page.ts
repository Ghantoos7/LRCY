import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { PostService } from 'src/app/services/post.service';
import { Router } from '@angular/router';
import { AlertController } from '@ionic/angular';

@Component({
  selector: 'app-comments',
  templateUrl: './comments.page.html',
  styleUrls: ['./comments.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class CommentsPage implements OnInit {

  
  user_name: string = '';
  post_media: string = '';
  post_caption: string = '';
  comment_count: number = 0;
  post_date: string = '';
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  comments: any = [];
  current_id = localStorage.getItem('userId') as string;
  comment_content: string ='';
  post_id: number = 0;
  isLiked: {[key: number]: boolean} = {};
  comment_likes: any;
  repliesOpen: {[key: number]: boolean} = {};
  replies: any = [];
  constructor(private alrt:AlertController, private router:Router, private postService:PostService, private alertController:AlertController) { }
 


  ngOnInit() {
    const data = this.router.getCurrentNavigation()?.extras.state;
    const post_id = JSON.stringify(data);
    const id = JSON.parse(post_id)["p_id"];
    this.post_id = id;
    

    this.postService.getPost(id).subscribe((data: any) => {
      this.user_name = data['post'].user_name;
      this.post_media = data['post'].post_media;
      this.post_caption = data['post'].post_caption;
      this.comment_count = data['post'].comment_count;
      this.post_date = data['post'].post_date;
    });

    this.postService.getComments(id).subscribe((data: any) => {
      this.comments = data['comments'];
      if (this.comments && this.comments.length > 0) {
        for (let i = 0; i < this.comments.length; i++) {
          const commentId = this.comments[i].id;
          this.isLiked[commentId] = localStorage.getItem(`comment_like_${commentId}`) === 'true';
        }
      }
    });
   
  }

  async openAlert() {
    const alert = await this.alrt.create({
      header: 'Sort Comments By',
      buttons: [
        {
          text: 'Sort',
          role: 'cancel'
        }
      ],
      inputs: [
        {
          name: 'radio-option',
          type: 'radio',
          label: 'Date',
          value: 'date',
          checked: false
        },
        {
          name: 'radio-option',
          type: 'radio',
          label: 'Popularity',
          value: 'likes',
          checked: false
        }
      ]
    });
  
    await alert.present();
  
    alert.onDidDismiss().then((data) => {
      const selectedValue = data.data['values'];
      if(selectedValue == 'likes'){
        this.postService.getSortedComments(this.post_id, "popularity").subscribe((data: any) => {
          this.comments = data['comments'];
          for (let i = 0; i < this.comments.length; i++) {
            const commentId = this.comments[i].id;
            this.isLiked[commentId] = localStorage.getItem(`comment_like_${commentId}`) === 'true'; // retrieve the like state from Local Storage
          
          }
          
      
        });
      }else{
        this.postService.getComments(this.post_id).subscribe((data: any) => {
          this.comments = data['comments'];
          for (let i = 0; i < this.comments.length; i++) {
            const commentId = this.comments[i].id;
            this.isLiked[commentId] = localStorage.getItem(`comment_like_${commentId}`) === 'true'; // retrieve the like state from Local Storage
          
          }
      
        });
       
      }
    });
  }

 

  toggleLike(comment_id: number) {
    if (this.isLiked[comment_id]) {
    this.unlikeComment(comment_id);
    } else {
    this.likeComment(comment_id);
    }
  }
    
  likeComment(comment_id: number) {
    this.postService.likeComment(comment_id, this.current_id).subscribe((data: any) => {
      localStorage.setItem(`comment_like_${comment_id}`, 'true'); // store the like state in Local Storage
      this.isLiked[comment_id] = true;
     
    });
    window.location.reload();
   
  }

  openReplies(comment_id: number){
    this.postService.getReplies(comment_id).subscribe((data: any) => {
      this.replies = data['replies'];
    });
    this.repliesOpen[comment_id] = !this.repliesOpen[comment_id];
  }

  unlikeComment(comment_id: number) {
    this.postService.unlikeComment(comment_id, this.current_id).subscribe((data: any) => {
      localStorage.setItem(`comment_like_${comment_id}`, 'false'); // store the like state in Local Storage
      this.isLiked[comment_id] = false;
    });
    window.location.reload();
   
  }

  
  async sendComment(){
  
    this.postService.commentPost(this.post_id, this.current_id, this.comment_content).subscribe(response=>{
      const str = JSON.stringify(response);
      const result = JSON.parse(str);
      const status = result['status'];
       if(status == "success"){
        this.alrt.create({
          message: 'Your comment was added!',
          buttons: ['OK']
        }).then(alrt => alrt.present());
        window.location.reload();
      }
    else if (status == "error"){
      this.alrt.create({
        message: 'Something went wrong.',
        buttons: ['OK']
      }).then(alrt => alrt.present());
      }
    });
    
   
  }

  deleteComment(comm_id: number){
    this.alertController.create({
      header: 'Confirm',
      message: 'Are you sure you want to delete this comment?',
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'
        },
        {
          text: 'Delete',
          handler: () => {
            this.postService.deleteComment(comm_id, this.current_id).subscribe(response=>{
              const str = JSON.stringify(response);
              const result = JSON.parse(str);
              const status = result['status'];
              if(status == "success"){
                window.location.reload();
              } else if (status == "error"){
                this.alrt.create({
                  message: 'Something went wrong. Please try again.',
                  buttons: ['OK']
                }).then(alrt => alrt.present());
              }
            });
          }
        }
      ]
    }).then(alert => alert.present());
  }


  goBack(){
    this.router.navigate(['/feed']);
  }



}
