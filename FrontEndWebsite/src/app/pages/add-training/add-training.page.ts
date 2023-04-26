import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from '../../services/admin.service';

@Component({
  selector: 'app-add-training',
  templateUrl: './add-training.page.html',
  styleUrls: ['./add-training.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddTrainingPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as string;
  trainings: any = [];
  users: any = [];
  selectedTrainings: number[] = [];
  selectedUsers: number[] = [];

  constructor(private router:Router, private menuCtrl: MenuController, private adminService: AdminService, private alertController: AlertController) { }

  ngOnInit() {
    this.adminService.getTrainingInfo("").subscribe((data: any) => {
      this.trainings = data['trainings'];
    });

    this.adminService.getUserInfo(this.branch_id, "").subscribe((data: any) => {
      this.users = data['users'].sort((a: any, b: any) => a.first_name.localeCompare(b.first_name));
    });
  }

  addTrainingForUsers() {
    this.adminService.addTrainingForUsers(this.selectedTrainings, this.selectedUsers).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if(parsedResponse.status == 'success') {
        this.alertController.create({
          header: 'Success',
          message: 'Trainings added successfully!',
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
  }

  toggleTrainingSelection(trainingId: number) {
    if (this.selectedTrainings.includes(trainingId)) {
      this.removeTrainingFromSelection(trainingId);
    } else {
      this.addTrainingToSelection(trainingId);
    }
  }

  toggleUserSelection(userId: number) {
    if (this.selectedUsers.includes(userId)) {
      this.removeUserFromSelection(userId);
    } else {
      this.addUserToSelection(userId);
    }
  }

  addTrainingToSelection(trainingId: number) {
    this.selectedTrainings.push(trainingId);
  }

  removeTrainingFromSelection(trainingId: number) {
    this.selectedTrainings = this.selectedTrainings.filter(id => id !== trainingId);

  }

  addUserToSelection(userId: number) {
    this.selectedUsers.push(userId);

  }

  removeUserFromSelection(userId: number) {
    this.selectedUsers = this.selectedUsers.filter(id => id !== userId);

  }

  goBack(){
    this.router.navigate(['/manage-profiles']);
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
    this.adminService.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
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
  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuAddTraining');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuAddTraining');
  }
}