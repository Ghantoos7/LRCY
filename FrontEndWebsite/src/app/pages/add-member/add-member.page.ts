import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from '../../services/admin.service';

@Component({
  selector: 'app-add-member',
  templateUrl: './add-member.page.html',
  styleUrls: ['./add-member.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddMemberPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as unknown as number;
  first_name: string = '';
  last_name: string = '';
  organization_id: any;
  user_dob: string = '';
  user_position: string = '';
  gender : string = '';
  user_type_id: string = '';
  is_active: string = '';
  user_start_date: string = '';
  user_end_date: string = '';

  darkMode: boolean = false;

  constructor(private router:Router, private menuCtrl: MenuController, private adminService: AdminService, private alertController: AlertController) { }

  ngOnInit() {
    const data = history.state.data;
    this.darkMode = data;
    console.log(data);
  }

  addUser(){
    this.adminService.addUser(this.branch_id,this.first_name,this.last_name,this.organization_id,this.user_dob,this.user_position,this.mapGender(this.gender),this.mapUserType(this.user_type_id),this.mapUserStatus(this.is_active),this.user_start_date,this.user_end_date).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if(parsedResponse.status == 'success') {
        this.alertController.create({
          header: 'Success',
          message: 'User added successfully!',
          buttons: ['OK']
        }).then(alert => alert.present());
        this.router.navigate(['/manage-profiles']);
      } else {
        this.alertController.create({
          header: 'Error',
          message: parsedResponse.error,
          buttons: ['OK']
        }).then(alert => alert.present());
      }
    }); 
  }

  mapGender(gender:string) :number{
    if(gender == 'Male'){
      return 0;
    }
    else if(gender == 'Female'){
      return 1;
    }
    else if(gender == "Other"){
      return 2;
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

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  goToHome(){
    this.adminService.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }

  goToAddTraining(){
    this.router.navigate(['/add-training'])
  }
  
  goToDeleteTraining(){
    this.router.navigate(['/delete-training']);
  }

  closeMenu() {
    this.menuCtrl.close();
  }

  goToManageProfiles(){
    this.router.navigate(['/manage-profiles']);
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuAddMember');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuAddMember');
  }

}
