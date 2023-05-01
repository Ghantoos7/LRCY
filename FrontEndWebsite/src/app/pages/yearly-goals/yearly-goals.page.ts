import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';
import { FormControl } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { debounceTime } from 'rxjs/operators';


@Component({
  selector: 'app-yearly-goals',
  templateUrl: './yearly-goals.page.html',
  styleUrls: ['./yearly-goals.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, ReactiveFormsModule]
})
export class YearlyGoalsPage implements OnInit {

  darkMode: boolean;

  constructor(private alertController: AlertController, private router:Router, private menuController: MenuController, private service:AdminService) {
    this.darkMode = localStorage.getItem('darkModeEnabled') === 'true';
    if (this.darkMode) {
       document.body.setAttribute('color-theme', 'dark');
    }
   }

  yearlyGoals: any;
  username = localStorage.getItem('username') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  branch_id = localStorage.getItem('branch_id') as string;
  filteredGoals: any;
  searchControl: FormControl = new FormControl('');


  ngOnInit() {

    this.router.events.subscribe((event) => {
      if (event instanceof NavigationEnd && event.url === '/yearly-goals') {
        this.fetchYearlyGoals();
      }
    });
  
  
    this.searchControl.valueChanges.pipe(debounceTime(300)).subscribe(() => {
      this.onSearchChange();
    });
  }

  fetchYearlyGoals() {
    this.service.getYearlyGoals(this.branch_id).subscribe((response: any) => {
      const allGoals = [].concat.apply([], Object.values(response['goals']));
      this.yearlyGoals = allGoals;
      this.filteredGoals = allGoals;
    });
  }

  

  onSearchChange() {
    this.filteredGoals = this.filterGoals(this.searchControl.value);
  }
  
  filterGoals(searchTerm: string) {
    return this.yearlyGoals.filter((goal: any) => {
      return goal.goal_name.toLowerCase().includes(searchTerm.toLowerCase());
    });
  }


  getProgramIcon(program_id: number,): string {
    // Replace the conditions with the appropriate ones for your use case
    if (program_id == 1) {
      return 'heart-half-outline';
    } 
    else if (program_id === 2) {
      return 'male-female-outline';
    } 
    else if (program_id === 3) {
      return 'leaf-outline';
    } 
    else if (program_id === 4) {
      return 'calendar-number-outline';
    }
    else {
      return 'help-circle-outline'; // Default icon
    }
  }

  getEventIcon(event_id: number,): string {
    // Replace the conditions with the appropriate ones for your use case
    if (event_id == 1) {
      return 'calendar-number-outline';
    } else if (event_id === 2) {
      return 'barbell-outline';
    } else if (event_id === 3) {
      return 'ellipsis-horizontal-outline';
    } else {
      return 'help-circle-outline'; // Default icon
    }
  }

  isGoalComplete(goal_status : boolean): string {
    if (goal_status == true) {
      return 'checkmark-circle-outline';
    } 
    else {
      return 'close-circle-outline';
    }
  }

  async confirm(goal_id: string) {
    const alert = await this.alertController.create({
      header: 'Delete Goal',
      message: 'Are you sure you want to delete this goal?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            this.service.deleteYearlyGoal(goal_id).subscribe((response: any) => {
                this.service.getYearlyGoals(this.branch_id).subscribe((data: any) => {
                  const allGoals = [].concat.apply([], Object.values(data['goals']));
                  this.yearlyGoals = allGoals;
                  this.filteredGoals = allGoals;
                  const parsedResponse = JSON.parse(JSON.stringify(response));
                  if(parsedResponse.status == 'success') {
                    this.alertController.create({
                      header: 'Success',
                      message: 'Goal deleted successfully',
                      buttons: ['OK']
                    }).then(alert => alert.present());
                    this.ngOnInit();
                  } else {
                    this.alertController.create({
                      header: 'Error',
                      message: parsedResponse.message,
                      buttons: ['OK']
                    }).then(alert => alert.present());
                  }

                });
            });
          }
        },
        {
          text: 'Cancel',
          role: 'cancel',
        }
      ]
    });
  
    await alert.present();
  }

  goToAddGoal(){
    this.router.navigate(['/add-goal']);
  }

  goToEditGoal(goal : any) {
    this.router.navigate(['/edit-goal'], { state: { goal: goal } });
  }
  closeMenu() {
    this.menuController.close();
  }

  goToHome(){
    this.service.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  ionViewWillLeave() {
    this.menuController.enable(false, 'menuGoals');
  }

  ionViewDidEnter() {
    this.menuController.enable(true, 'menuGoals');
  }
}
