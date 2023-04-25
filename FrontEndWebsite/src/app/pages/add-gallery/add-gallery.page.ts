import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-add-gallery',
  templateUrl: './add-gallery.page.html',
  styleUrls: ['./add-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddGalleryPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as string;
  event_title: string = '';
  event_description: string = '';
  event_date: string = '';
  event_type_id: string = '';
  program: string = '';
  event_main_picture: string = '';
  event_location: string = '';
  budget_sheet: string = '';
  proposal: string = '';
  responsibles: any=[];
  meeting_minute: string = '';
  program_id: number=0;

  constructor(private router:Router, private menuController: MenuController, private service:AdminService) { }

  ngOnInit() {

  }

 convertProgram() {
    switch (this.program) {
      case 'Youth and health':
        this.program_id = 1;
        break;
      case 'Environment':
        this.program_id = 2;
        break;
      case 'HIP':
        this.program_id = 3;
        break;
      case 'Other':
        this.program_id = 4;
        break;
      default:
        this.program_id = 0; //change api so that if program id is 0 it will say program id should be added
        break;
    }
    //make the program_id based on programs table
  }
  

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  goToHome(){
    this.service.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }

  goToGallery(){
    this.router.navigate(['/manage-gallery']);
  }
  
  closeMenu() {
    this.menuController.close();
  }

}
