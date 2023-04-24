import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';


@Component({
  selector: 'app-edit-announcement',
  templateUrl: './edit-announcement.page.html',
  styleUrls: ['./edit-announcement.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditAnnouncementPage implements OnInit {

  announcement_id: string = "";
  announcement_title: string="";
  announcement_content: string="";
  importance_level: string="";
  admin_id = localStorage.getItem('adminId') as string;
  refresh: boolean = true;
  constructor(private router:Router, private adminService:AdminService, private alertController:AlertController) { }

  ngOnInit() {
    const announcement = history.state.announcement;
    this.announcement_title = announcement.announcement_title;
    this.announcement_content = announcement.announcement_content;
    this.importance_level = announcement.importance_level;
    this.announcement_id = announcement.id;
  }

  editAnnouncement(title: string, content: string, importance_level: string){
    this.adminService.editAnnouncement(this.announcement_id, this.admin_id, title, content, importance_level).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if(parsedResponse.status == 'success') {
        this.alertController.create({
          header: 'Success',
          message: 'Announcement updated successfully!',
          buttons: ['OK']
        }).then(alert => alert.present());
        this.router.navigate(['/announcements']);
      } else {
        this.alertController.create({
          header: 'Error',
          message: parsedResponse.message,
          buttons: ['OK']
        }).then(alert => alert.present());
      }
    }); 
  }

  mapImportanceLevel(importanceLevel: string): number {
    switch(importanceLevel) {
      case 'Optional':
        return 0;
      case 'Important':
        return 1;
      case 'Urgent':
        return 2;
      default:
        return 3;
    }
  }  

  goToAnnouncements(){
    this.router.navigate(['/announcements']);
  }

  goToSendAnnouncement(){
    this.router.navigate(['/send-announcement']);
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
