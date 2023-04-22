import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})
export class ProfilePage implements OnInit {

  user:any = [];
  first_name:string = '';
  last_name:string = '';
  full_name:string = '';
  username = localStorage.getItem('username') as string;
  bio:string = '';
  user_position:string = '';
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  user_id = localStorage.getItem('userId') as string;
  branch_id = localStorage.getItem('branchId') as string;

  constructor(private router:Router, private service:UserService,private menuCtrl: MenuController) { }

  async ngOnInit() {
    this.service.getUser(this.branch_id,this.user_id).subscribe(response => {
      this.user = response;
      this.last_name = (this.user['user'].last_name);
      this.first_name = (this.user['user'].first_name);
      this.full_name = this.first_name + ' ' + this.last_name;
      this.username = (this.user['user'].username);
      this.bio = (this.user['user'].user_bio);
      this.user_position = (this.user['user'].user_position);
    });


  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuProfile');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuProfile');
  }

  goToEditForm(){
this.router.navigate(['edit-profile']);
  }

  goProfile(){
    this.router.navigate(['/profile']);
      }
    
      goFeed(){
        this.router.navigate(['/feed']);
      }
      
      goGoals(){
        this.router.navigate(['/yearly-goals']);
      }
    
      goGallery(){
        this.router.navigate(['/gallery']);
      }
    
      goAnnouncements(){
        this.router.navigate(['/announcements']);
      }
    
      toggleDarkMode(){
    
      }
      logout() {
        this.service.logout().subscribe((data: any) => {
          localStorage.clear();
          this.router.navigate(['/sign-in']);
        });
      }
}
