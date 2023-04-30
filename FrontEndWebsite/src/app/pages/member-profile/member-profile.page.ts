import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-member-profile',
  templateUrl: './member-profile.page.html',
  styleUrls: ['./member-profile.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class MemberProfilePage implements OnInit {

  first_name : string = '';
  last_name : string = '';
  organization_id : string = '';
  user_type_id : string = '';
  user_position : string = '';
  is_active : string = '';
  user_dob : string = '';
  gender : string = '';
  user_start_date : string = '';
  user_end_date : string = '';
  user_profile_pic : string = '';
  user_id: string = '';
  gender_id: number = 0;
  gender_name: string = '';

  constructor(private router:Router, private menuCtrl: MenuController, private alertController: AlertController, private adminService : AdminService) { }

  ngOnInit() {
    const user = history.state.user;
    this.user_id = user.id;
    this.first_name = user.first_name;
    this.last_name = user.last_name;
    this.organization_id = user.organization_id;
    this.user_type_id =  this.mapUserTypeName(user.user_type_id);
    this.user_position = user.user_position;
    this.is_active = this.mapUserStatusName(user.is_active);
    this.user_dob = user.user_dob;
    this.user_start_date = user.user_start_date;
    this.user_end_date = user.user_end_date;
    this.user_profile_pic = user.user_profile_pic;
    this.gender_name = this.mapGender(user.gender);
    this.gender = user.gender;
  }

  editUser(){
    this.adminService.editUser(this.user_id, this.first_name,this.last_name,this.mapUserStatus(this.is_active), this.user_start_date,this.user_end_date,this.user_position, this.mapUserType(this.user_type_id), this.gender,this.user_dob).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if(parsedResponse.status == 'success') {
        this.alertController.create({
          header: 'Success',
          message: 'User information updated successfully!',
          buttons: ['OK']
        }).then(alert => alert.present());
        this.router.navigate(['/manage-profiles']);
      } else {
        this.alertController.create({
          header: 'Error',
          message: parsedResponse.errors,
          buttons: ['OK']
        }).then(alert => alert.present());
      }
    }); 
  
  }

  mapGender(gender : number) : string{
    if(gender == 0){
      return "Male"
    }
    else if (gender == 1){
      return "Female"
    }
    else{
      return "Other"
    }
  }

  mapUserTypeName(user_type_id: number) : string{
    if(user_type_id == 1){
      return "Admin"
    }
    else{
      return "User"
    }
  }

  mapUserStatusName(is_active: number): string{
    if(is_active == 1){
      return "Active"
    }
    else{
      return "Inactive"
    }
  }


  mapUserType(user_type_id: string) : number{
    if(user_type_id == 'Admin'){
      return 1;
    }
    else{
      return 0;
    }
  }


  mapUserStatus(is_active: string): number{
    if(is_active == 'Active'){
      return 1;
    }
    else{
      return 0;
    }
  }


  async confirm(user_id: string) {
    const alert = await this.alertController.create({
      header: 'Delete Profile',
      message: 'Are you sure you want to remove this member?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            this.adminService.deleteUser(user_id).subscribe((response: any) => {
              const parsedResponse = JSON.parse(JSON.stringify(response));
              if(parsedResponse.status == 'success') {
                this.alertController.create({
                  header: 'Success',
                  message: 'user deleted successfully',
                  buttons: ['OK']
                }).then(alert => alert.present());
                this.router.navigate(['/manage-profiles']);
              } else {
                this.alertController.create({
                  header: 'Error',
                  message: parsedResponse.message,
                  buttons: ['OK']
                }).then(alert => alert.present());
              }
            });
          },
        },
        {
          text: 'Cancel',
          role: 'cancel',
        },
      ],
    });
    await alert.present();
  }

  exitPage(){
    this.router.navigate(['/manage-profiles']);
  }

  goToAddTraining(){
    this.router.navigate(['/add-training'])
  }
  
  goToDeleteTraining(){
    this.router.navigate(['/delete-training']);
  }

  goToAddForm(){
    this.router.navigate(['/add-member'])
  }

  closeMenu() {
    this.menuCtrl.close();
  }

  goToManageProfiles(){
    this.router.navigate(['/manage-profiles']);
  }

  goToHome(){
    this.adminService.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
