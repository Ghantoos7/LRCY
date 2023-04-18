import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { AuthService } from '../../services/auth.service';
import { HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})
export class ProfilePage implements OnInit {

  users:any = [];
  name:string = '';

  constructor(private router:Router, private service:AuthService) { }

  async ngOnInit() {
    this.service.get_user('1', '').subscribe(response => {
      this.users = response;
      this.name = this.users['users']['0'].first_name;
      console.log(this.users['users']['0'].first_name);
    });
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
      logout(){
      
      }

}
