import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];
  announcements: any = [];
  i: number = 0;
  current_id = localStorage.getItem('adminId') as string;
  branch_id = localStorage.getItem('branch_id') as string;
  constructor(private alertController: AlertController, private router:Router, private menuController: MenuController, private adminService:AdminService) { 
    this.showDescriptions = new Array(this.announcements.length).fill(false);
  }

  ngOnInit() {
    this.adminService.getAnnouncements(this.branch_id).subscribe((response: any) => {
      this.announcements = response['announcements'];
      this.announcements = Array.from(this.announcements);

    });
  }

  public getAnnouncerProfilePic(index: number) {
    let currentAnnouncement = this.announcements[index];
    if (currentAnnouncement.announcer_profile_picture == null) {
      return "https://ionicframework.com/docs/img/demos/avatar.svg";
    } else {
      return currentAnnouncement.announcer_profile_picture;
    }
  }

  async confirm(id: string) {
    const alert = await this.alertController.create({
      header: 'Delete Announcement',
      message: 'Are you sure you want to delete this announcement?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            this.adminService.deleteAnnouncement(id, this.current_id).subscribe((response: any) => {
              const parsedResponse = JSON.parse(JSON.stringify(response));
              if(parsedResponse.status == 'success') {
                this.alertController.create({
                  header: 'Success',
                  message: 'Announcement deleted successfully!',
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
            }
            );
        },
        },
        {
          text: 'Cancel',
          role: 'cancel',
        }
      ]
    });
    await alert.present();
  }

  toggleDescription(index: number) {
    this.showDescriptions[index] = !this.showDescriptions[index];
  }

  goToSendAnnouncement(){
    this.router.navigate(['/send-announcement']);
  }

  goToEditAnnouncement(){
    this.router.navigate(['/edit-announcement']);
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  closeMenu() {
    this.menuController.close();
  }

}
