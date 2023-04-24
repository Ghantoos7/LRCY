import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from '../../services/admin.service';
import { debounceTime } from 'rxjs/operators';
import { FormControl } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'app-manage-profiles',
  templateUrl: './manage-profiles.page.html',
  styleUrls: ['./manage-profiles.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule,ReactiveFormsModule]
})
export class ManageProfilesPage implements OnInit {


  searchControl: FormControl = new FormControl('');
  branch_id = localStorage.getItem('branch_id') as string;
  searchQuery = '';
  usersByLetter: { [letter: string]: any[] } = {};
  filteredUsersByLetter: { [letter: string]: any[] } = {};

  constructor(private router:Router, private menuCtrl: MenuController, private adminService :AdminService) { }

  

  ngOnInit() {
    this.adminService.getUserInfo(this.branch_id, "").subscribe((data: any) => {
      this.processUsers(data['users']);
    });
  
    this.searchControl.valueChanges.pipe(debounceTime(300)).subscribe((searchQuery: string) => {
      this.searchQuery = searchQuery;
      this.filterUsers();
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
    this.filterUsers();
  }
  
  filterUsers() {
    const query = this.searchQuery.trim().toLowerCase();
    this.filteredUsersByLetter = {};
    for (const letter in this.usersByLetter) {
      const filteredUsers = this.usersByLetter[letter].filter(user =>
        (user.first_name.toLowerCase() + ' ' + user.last_name.toLowerCase()).includes(query)
      );
      if (filteredUsers.length > 0) {
        this.filteredUsersByLetter[letter] = filteredUsers;
      }
    }
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

  goToProfile(user : any){
    this.router.navigate(['/member-profile'], { state: { user: user } });
  }

}
