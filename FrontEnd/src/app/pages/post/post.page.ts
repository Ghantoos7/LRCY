import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { UserService } from 'src/app/services/user.service';
import { PostService } from 'src/app/services/post.service';
import { DomSanitizer } from '@angular/platform-browser';
import { SafeUrl } from '@angular/platform-browser';

@Component({
  selector: 'app-post',
  templateUrl: './post.page.html',
  styleUrls: ['./post.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class PostPage implements OnInit {

  user:any = [];
  first_name:string = '';
  last_name:string = '';
  full_name:string = '';
  username = localStorage.getItem('username') as string;
  user_profile_pic :string = '';
  user_id = localStorage.getItem('user_id') as string;
  branch_id = localStorage.getItem('branch_id') as string;
  post_caption:string='';
  post_src_img: any;
  post_src_img_data: SafeUrl | null = null; 

  constructor(private router:Router, private userService:UserService, private postService:PostService, private sanitizer: DomSanitizer) { }

  ngOnInit() {
    this.userService.getUser(this.branch_id, this.user_id).subscribe(response => {
      this.user = response;
      this.last_name = (this.user['user'].last_name);
      this.first_name = (this.user['user'].first_name);
      this.full_name = this.first_name + ' ' + this.last_name;
      this.username = (this.user['user'].username);
      this.user_profile_pic = (this.user['user'].user_profile_pic);
    });
  }

  goBack(){
    this.router.navigate(['/feed']);
  }



  onChange(event: any) {
      this.post_src_img = event.target.files[0];

      // Add this block to read and store the image data
    const reader = new FileReader();
    reader.onload = (e) => {
      this.post_src_img_data = this.sanitizer.bypassSecurityTrustUrl(
        e.target?.result as string
      );
    };
    reader.readAsDataURL(this.post_src_img);
  }

  post(){
    
      const formData = new FormData();
      formData.append('user_id', this.user_id);
      if (!this.post_src_img) {
        formData.append('post_type', 'text');
      }else{
      formData.append('post_type', 'image');
      }
      formData.append('post_caption', this.post_caption);
      formData.append('post_media', this.post_src_img);
      this.postService.post(formData).subscribe((response) => {
        const parsedResponse = JSON.parse(JSON.stringify(response));
        if(parsedResponse.status == 'success'){
          
this.router.navigate(['/feed']);
        }
      });
    
}
}

