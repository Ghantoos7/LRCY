import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { PostService } from 'src/app/services/post.service';
import { AlertController } from '@ionic/angular';
import { NavController } from '@ionic/angular';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'app-edit-post',
  templateUrl: './edit-post.page.html',
  styleUrls: ['./edit-post.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditPostPage implements OnInit {
  
  post_caption: string = '';
  
  post_id: string ='';
  
  post_src_img: any;

  post_src_video: any;

  media_type: number = 0;

  constructor(private alrt:AlertController, private postService:PostService, private router:Router, private sanitizer:DomSanitizer) { }

  ngOnInit() {
    const data = this.router.getCurrentNavigation()?.extras.state;
    const post_id = JSON.stringify(data);
    const id = JSON.parse(post_id)["p_id"];
    this.post_id = id;
    this.postService.getPost(id).subscribe((data: any) => {
      this.post_caption = data['post'].post_caption;
      this.media_type = data['post'].post_type_id;
  
      // Prepend the server base URL to the image/video URL
      const server_base_url_image = 'http://127.0.0.1:8000/storage/images/';
      const server_base_url_video = 'http://127.0.0.1:8000/storage/videos/';
  
      // Sanitize the image URL, if needed
      if (this.media_type === 2) {
        this.post_src_img = this.sanitizer.bypassSecurityTrustUrl(server_base_url_image + data['post'].post_media);
      } else if (this.media_type === 3) {
        this.post_src_video = this.sanitizer.bypassSecurityTrustUrl(server_base_url_video + data['post'].post_media);
      }
    });
  }
  
  
  

  editPost(){
    this.postService.editPost(this.post_id, this.post_caption).subscribe((data: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(data));
      const status = parsedResponse.status;
      if(status == "success"){
        this.post_caption='';
        this.post_src_img='';
        this.post_src_video='';
        this.alrt.create({
          header: 'Your post has been edited!',
          message: status,
          buttons: ['OK']
        }).then((alert) => alert.present())
        .catch((err) => console.log(err));
      this.router.navigate(['/profile/My-Posts'])
      }else{
        this.alrt.create({
          header: 'Error',
          message: status,
          buttons: ['OK']
        }).then((alert) => alert.present())
        .catch((err) => console.log(err));
      }
    });

  }

  goBack() {
    this.alrt.create({
      header: 'Confirm',
      message: 'If you leave this page, your changes will be discarded. Are you sure you want to leave?',
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel',
        },
        {
          text: 'Leave',
          handler: () => {
            this.router.navigate(['/profile/My-Posts']);
          },
        },
      ],
    }).then((alert) => alert.present())
    .catch((err) => console.log(err));
  };
}
