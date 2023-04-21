import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { UserService } from 'src/app/services/user.service';
import { PostService } from 'src/app/services/post.service';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx';

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

  imageData: string='';

  constructor(private router:Router, private userService:UserService, private postService:PostService, private camera: Camera) { }

  ngOnInit() {
    this.userService.get_user('1', '1').subscribe(response => {
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

  takePicture(imageData: string) {
    const options: CameraOptions = {
      quality: 50,
      destinationType: this.camera.DestinationType.DATA_URL,
      encodingType: this.camera.EncodingType.JPEG,
      mediaType: this.camera.MediaType.PICTURE
    }

    this.camera.getPicture(options).then((imageData) => {
      // imageData is a base64 encoded string
      let base64Image = 'data:image/jpeg;base64,' + imageData;
      // Do something with the image data, like displaying it in an <img> tag
    }, (err) => {
      // Handle error
    });
  }

  choosePicture(imageData: string) {
    const options: CameraOptions = {
      quality: 50,
      destinationType: this.camera.DestinationType.DATA_URL,
      encodingType: this.camera.EncodingType.JPEG,
      mediaType: this.camera.MediaType.PICTURE,
      sourceType: this.camera.PictureSourceType.PHOTOLIBRARY
    }

    this.camera.getPicture(options).then((imageData) => {
      // imageData is a base64 encoded string
      let base64Image = 'data:image/jpeg;base64,' + imageData;
      // Do something with the image data, like displaying it in an <img> tag
    }, (err) => {
      // Handle error
    });
  }

}

}
