import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { PopoverController } from '@ionic/angular';
import { ActionSheetController } from '@ionic/angular';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-my-posts',
  templateUrl: './my-posts.page.html',
  styleUrls: ['./my-posts.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})
export class MyPostsPage implements OnInit {

  
  posts: any  = [];
  posts_array: any = [];

  constructor(private router: Router, private alertController: AlertController, private actionSheetController: ActionSheetController, private service: UserService) { }

  ngOnInit() {
    this.service.get_own_posts('1').subscribe(response => {
      this.posts = response;
      this.posts_array = Array.from(this.posts['posts']);
      console.log(this.posts_array);
    });
  }

  async showActionSheet(){
    const actionSheet = await this.actionSheetController.create({
      header: 'Options',
      buttons: [
        {
          text: 'Edit',
          icon: 'create-outline',
          handler: () => {
            // Implement the edit action here
            console.log('Edit clicked');
          }
        },
        {
          text: 'Delete',
          icon: 'trash-outline',
          handler: () => {
            // Implement the delete action here
            console.log('Delete clicked');
          }
        },
        {
          text: 'Cancel',
          icon: 'close',
          role: 'cancel',
          handler: () => {
            console.log('Cancel clicked');
          }
        }
      ]
    });
    await actionSheet.present();
  }
  }

 



