import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { AdminService } from 'src/app/services/admin.service';

@Component({
  selector: 'app-edit-gallery',
  templateUrl: './edit-gallery.page.html',
  styleUrls: ['./edit-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditGalleryPage implements OnInit {

  constructor(private router:Router, private menuController: MenuController, private alertController: AlertController, private adminService : AdminService) { }

  ngOnInit() {
  }

  async confirm() {
    const alert = await this.alertController.create({
      header: 'Delete Event',
      message: 'Are you sure you want to remove this event?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
        },
        {
          text: 'Cancel',
          role: 'cancel',
        }
      ]
    });
    await alert.present();
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  goToHome(){
    this.adminService.logout().subscribe((response: any) => {
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
