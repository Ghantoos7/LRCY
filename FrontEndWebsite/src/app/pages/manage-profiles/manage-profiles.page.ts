import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from '../../services/admin.service';

@Component({
  selector: 'app-manage-profiles',
  templateUrl: './manage-profiles.page.html',
  styleUrls: ['./manage-profiles.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class ManageProfilesPage implements OnInit {
  
  branch_id = localStorage.getItem('branch_id') as string;
  usersByLetter: { [letter: string]: any[] } = {};

  constructor(private router:Router, private menuCtrl: MenuController, private adminService :AdminService) { }

  

  ngOnInit() {
    this.adminService.getUserInfo(this.branch_id, "").subscribe((data: any) => {
      this.processUsers(data['users']);
      console.log(data['users'])
      
    });
  }

  processUsers(users: any[]) {
    users.forEach(user => {
      const firstLetter = user.first_name[0].toUpperCase();
      if (!this.usersByLetter[firstLetter]) {
        this.usersByLetter[firstLetter] = [];
      }
      this.usersByLetter[firstLetter].push(user);
    });
  }


  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuProfiles');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuProfiles');
  }

  goToAddForm(){
    this.router.navigate(['/add-member'])
  }

  goToAddTraining(){
    this.router.navigate(['/add-training'])
  }
  
  goToDeleteTraining(){
    this.router.navigate(['/delete-training']);
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  closeMenu() {
    this.menuCtrl.close();
  }

  goToProfile(){
    this.router.navigate(['/member-profile']);
  }

}
