  import { Component, OnInit } from '@angular/core';
  import { CommonModule } from '@angular/common';
  import { FormsModule } from '@angular/forms';
  import { IonicModule,AlertController } from '@ionic/angular';
  import { Router } from '@angular/router';
  import { ActivatedRoute } from '@angular/router';
  import { AdminService } from 'src/app/services/admin.service';


  @Component({
    selector: 'app-edit-goal',
    templateUrl: './edit-goal.page.html',
    styleUrls: ['./edit-goal.page.scss'],
    standalone: true,
    imports: [IonicModule, CommonModule, FormsModule]
  })
  export class EditGoalPage implements OnInit {

    goal_info: any ;
    goal_id: number = 0;
    branch_id = localStorage.getItem('branchId') as unknown as number;
    goal_name: string = '';
    goal_description: string = '';
    number_completed: number = 0;
    number_to_complete: number = 0;
    program_id: string = '';
    event_type_id: string = '';
    goal_year: number = 0;
    start_date: string = '';
    goal_deadline: string = '';



    constructor(private router:Router,private route: ActivatedRoute, private adminService: AdminService, private alertController: AlertController) { }

    ngOnInit() {
      const goal = history.state.goal;
      this.goal_id = goal.id;
      this.goal_name = goal.goal_name;
      this.goal_description = goal.goal_description;
      this.number_completed = goal.number_completed;
      this.number_to_complete = goal.number_to_complete;
      this.program_id = this.mapProgramId(goal.program_id);
      this.event_type_id = this.mapEventTypeId(goal.event_type_id);
      this.goal_year = goal.goal_year;
      this.start_date = goal.start_date;
      this.goal_deadline = goal.goal_deadline;

      }
    
    editYearlyGoal(){
      this.adminService.editYearlyGoal(this.goal_id, this.branch_id, this.goal_name, this.goal_description, this.number_completed, this.number_to_complete, this.mapProgramName(this.program_id), this.mapEventType(this.event_type_id), this.goal_year, this.start_date, this.goal_deadline).subscribe((response: any) => {
        const parsedResponse = JSON.parse(JSON.stringify(response));
        if(parsedResponse.status == 'success') {
          this.alertController.create({
            header: 'Success',
            message: 'Goal updated successfully!',
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

    mapProgramId(programId: number): string {
        switch(programId) {
          case 1:
            return 'Youth and Health';
          case 2:
            return 'Human values and principles';
          case 3:
            return 'Environment';
          case 4:
            return "Other";
          default:
            return 'Other';
        }
      }

    mapEventTypeId(eventTypeId: number): string {
        switch(eventTypeId) {
          case 1:
            return 'Activity';
          case 2:
            return 'Training';
          case 3:
            return 'Other';
          default:
            return 'Other';
        }
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

    goToAddGoal(){
      this.router.navigate(['/add-goal']);
    }

    goToHome(){
      this.router.navigate(['/home']);
    }

    goToPanel(){
      this.router.navigate(['/panel']);
    }

  }
