import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { PostService } from 'src/app/services/post.service';
@Component({
  selector: 'app-edit-post',
  templateUrl: './edit-post.page.html',
  styleUrls: ['./edit-post.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditPostPage implements OnInit {
user_bio: string = '';
  constructor(private postService:PostService, private router:Router) { }

  ngOnInit() {
    const data = this.router.getCurrentNavigation()?.extras.state;
    const post_id = JSON.stringify(data);
    const id = JSON.parse(post_id)["p_id"];
    
    this.postService.getPost(id).subscribe((data: any) => {
      this.user_bio = data['post'].post_caption;
    });

  }

  editPost(){

  }

}
