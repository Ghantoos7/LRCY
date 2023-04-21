import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule } from '@ionic/angular';
import { UserService } from 'src/app/services/user.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-edit-profile',
  templateUrl: './edit-profile.page.html',
  styleUrls: ['./edit-profile.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditProfilePage implements OnInit {

  user:any = [];
  first_name:string = '';
  last_name:string = '';
  full_name:string = '';
  username:string = '';
  user_bio:string = '';
  user_position:string = '';


  constructor(private service:UserService, private alertController:AlertController, private router:Router) { }

  ngOnInit() {
    this.service.get_user('1', '1').subscribe(response => {
      this.user = response;
      this.last_name = (this.user['user'].last_name);
      this.first_name = (this.user['user'].first_name);
      this.full_name = this.first_name + ' ' + this.last_name;
      this.username = (this.user['user'].username);
      this.user_bio = (this.user['user'].user_bio);
      this.user_position = (this.user['user'].user_position);
    });
  }

  editProfileWithoutPic(username: string, user_bio: string){
    this.service.editProfile(username, user_bio).subscribe(response => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if (parsedResponse.status === 'success') {
        const alert = this.alertController.create({
          header: 'Success',
          message: 'Profile updated successfully.',
          buttons: ['OK']
        });

        alert.then(res => {
          res.present();
          this.router.navigate(['/profile']); // navigate to profile page after successful update
        });
      } else {
        const alert = this.alertController.create({
          header: 'Error',
          message: 'An error occurred while updating your profile. Please try again later.',
          buttons: ['OK']
        });

        alert.then(res => {
          res.present();
        });
      }
    });
}


}
