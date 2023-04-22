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
  user_id = localStorage.getItem('user_id') as string;
  branch_id = localStorage.getItem('branch_id') as string;

  constructor(private router:Router, private userService:UserService, private postService:PostService) { }

  ngOnInit() {
    this.userService.getUser(this.branch_id,this.user_id).subscribe(response => {
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

}

