import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { PostService } from 'src/app/services/post.service';

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

  comments: any = [];

  constructor(private postService:PostService) { }

  ngOnInit() {
    this.postService.getPost(26).subscribe((data: any) => {
      this.user_name = data['post'].user_name;
      this.post_media = data['post'].post_media;
      this.post_caption = data['post'].post_caption;
      this.comment_count = data['post'].comment_count;
      this.post_date = data['post'].post_date;
    });

    this.postService.getComments(26).subscribe((data: any) => {
      this.comments = data['comments'];
    });
  }


}
