import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { UserService } from 'src/app/services/user.service';
import { PostService } from 'src/app/services/post.service';

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
  user_id = localStorage.getItem('userId') as string;
  branch_id = localStorage.getItem('branch_id') as string;
post_caption:string='';
post_src_img: any;

  constructor(private router:Router, private userService:UserService, private postService:PostService) { }

  ngOnInit() {
    console.log(this.user_id);
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

  readFileAsBase64(file: File): Promise<string> {
    return new Promise<string>((resolve, reject) => {
      const reader = new FileReader();
      reader.onloadend = () => {
        resolve(reader.result as string);
      };
      reader.onerror = () => {
        reject(reader.error);
      };
      reader.readAsDataURL(file);
    });
  }

  onChange(event: any) {
    this.post_src_img = event.target.files[0];

  }

  post(){
    if (this.post_src_img) {
      const formData = new FormData();
      formData.append('user_id', this.user_id);
      formData.append('post_type', 'image');
      formData.append('post_caption', this.post_caption);
      formData.append('post_media', this.post_src_img);
      
      this.postService.post(formData).subscribe((response) => {
        const parsedResponse = JSON.parse(JSON.stringify(response));
        if(parsedResponse.status == 'success'){
this.router.navigate(['/feed']);
        }
      });
    } else {
      console.error('No file selected.');
    }
}
}

