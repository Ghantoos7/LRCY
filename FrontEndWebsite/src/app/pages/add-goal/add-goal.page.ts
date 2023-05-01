import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-add-goal',
  templateUrl: './add-goal.page.html',
  styleUrls: ['./add-goal.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddGoalPage implements OnInit {

  goal_id: number = 0;
  branch_id = parseInt(localStorage.getItem('branch_id') as string, 10);  
  goal_name: string = '';
  goal_description: string = '';
  number_to_complete: any;
  program_id: string = '';
  event_type_id: string = '';
  goal_year: any;
  start_date: string = '';
  goal_deadline: string = '';
  darkMode: boolean;

  constructor(private router:Router, private menuController: MenuController, private adminService: AdminService, private alertController: AlertController) {
    this.darkMode = localStorage.getItem('darkModeEnabled') === 'true';
    if (this.darkMode) {
       document.body.setAttribute('color-theme', 'dark');
    }
   }

  ngOnInit() {
  }

  setYearlyGoal(){
    this.adminService.setYearlyGoal(this.branch_id, this.goal_name, this.goal_description, this.number_to_complete, this.mapProgramName(this.program_id), this.mapEventType(this.event_type_id), this.goal_year, this.start_date, this.goal_deadline).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if(parsedResponse.status == 'success') {
        this.alertController.create({
          header: 'Success',
          message: 'Goal added successfully!',
          buttons: ['OK']
        }).then(alert => alert.present());
        this.router.navigate(['/yearly-goals']);
      } else {
        this.alertController.create({
          header: 'Error',
          message: parsedResponse.message,
          buttons: ['OK']
        }).then(alert => alert.present());
      }
    }); 
  }
 
      


  mapProgramName(programName: string): number {
    switch(programName) {
      case 'Youth and Health':
        return 1;
      case 'Human values and principles':
        return 2;
      case 'Environment':
        return 3;
      case "Other":
        return 4;
      default:
        return 5;
    }
  }

mapEventType(eventType: string): number {
    switch(eventType) {
      case 'Activity':
        return 1;
      case 'Training':
        return 2;
      case 'Other':
        return 3;
      default:
        return 4;
    }
  } 

  pinFormatter(value: number) {
    return `${value}%`;
  }

  goToGoals(){
    this.router.navigate(['/yearly-goals']);
  }

  closeMenu() {
    this.menuController.close();
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

  ionViewWillLeave() {
    this.menuController.enable(false, 'menuAddGoals');
  }

  ionViewDidEnter() {
    this.menuController.enable(true, 'menuAddGoals');
  }

}
