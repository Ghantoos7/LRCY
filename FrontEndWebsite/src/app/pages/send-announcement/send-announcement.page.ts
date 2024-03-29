import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-send-announcement',
  templateUrl: './send-announcement.page.html',
  styleUrls: ['./send-announcement.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SendAnnouncementPage implements OnInit {

  announcement_title: string = "";
  announcement_content: string = "";
  importance_level: string = "";
  darkMode: boolean;

  admin_id = localStorage.getItem('admin_id') as string;

  constructor(private router:Router, private menuController: MenuController, private adminService:AdminService, private alertController:AlertController) {
    this.darkMode = localStorage.getItem('darkModeEnabled') === 'true';
    if (this.darkMode) {
      document.body.setAttribute('color-theme', 'dark');
    }
   }

  ngOnInit() {
  }

  sendAnnouncement(announcement_title: string, announcement_content: string, importance_level: string) {
    this.adminService.sendAnnouncement(announcement_title, announcement_content, importance_level, this.admin_id).subscribe((response: any) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      if(parsedResponse.status == 'success') {
  
        this.alertController.create({
          header: 'Success',
          message: 'Announcement sent successfully!',
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

  closeMenu() {
    this.menuController.close();
  }

  ionViewWillLeave() {
    this.menuController.enable(false, 'menuSendAnnouncements');
  }

  ionViewDidEnter() {
    this.menuController.enable(true, 'menuSendAnnouncements');
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

  

}
