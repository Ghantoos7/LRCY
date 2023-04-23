import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { MenuController } from '@ionic/angular';
import { Router } from '@angular/router';

@Component({
  selector: 'app-manage-gallery',
  templateUrl: './manage-gallery.page.html',
  styleUrls: ['./manage-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class ManageGalleryPage implements OnInit {

  constructor(private menuCtrl: MenuController, private router:Router, private menuController: MenuController) { }

  ngOnInit() {
  }

  goToAddForm(){
    this.router.navigate(['/add-gallery'])
  }
  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuGallery');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuGallery');
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
