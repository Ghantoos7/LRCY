import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-manage-gallery',
  templateUrl: './manage-gallery.page.html',
  styleUrls: ['./manage-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class ManageGalleryPage implements OnInit {

  constructor(private menuCtrl: MenuController) { }

  ngOnInit() {
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuGallery');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuGallery');
  }

}
