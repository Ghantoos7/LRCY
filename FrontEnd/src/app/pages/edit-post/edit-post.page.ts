import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { PostService } from 'src/app/services/post.service';
import { AlertController } from '@ionic/angular';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-edit-post',
  templateUrl: './edit-post.page.html',
  styleUrls: ['./edit-post.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditPostPage implements OnInit {
user_bio: string = '';
post_id: string ='';
  constructor(private alrt:AlertController, private postService:PostService, private router:Router) { }

  ngOnInit() {
    const data = this.router.getCurrentNavigation()?.extras.state;
    const post_id = JSON.stringify(data);
    const id = JSON.parse(post_id)["p_id"];
    this.post_id = id;
    this.postService.getPost(id).subscribe((data: any) => {
      this.user_bio = data['post'].post_caption;
    });

  }

  editPost(){
    this.postService.editPost(this.post_id, this.user_bio).subscribe((data: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(data));
      const status = parsedResponse.status;
      if(status == "success"){
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

}
