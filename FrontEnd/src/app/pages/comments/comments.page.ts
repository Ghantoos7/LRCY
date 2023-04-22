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
  constructor(private alrt:AlertController, private router:Router, private postService:PostService) { }

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
    });
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
    this.postService.deleteComment(comm_id, this.current_id).subscribe(response=>{
      const str = JSON.stringify(response);
      const result = JSON.parse(str);
      const status = result['status'];
      console.log(status);
       if(status == "success"){
        this.alrt.create({
          message: 'Your comment was deleted!',
          buttons: ['OK']
        }).then(alrt => alrt.present());
        window.location.reload();
      }
    else if (status == "error"){
      this.alrt.create({
        message: 'Something went wrong. Please try again.',
        buttons: ['OK']
      }).then(alrt => alrt.present());
      }
    });
    
  }





}
