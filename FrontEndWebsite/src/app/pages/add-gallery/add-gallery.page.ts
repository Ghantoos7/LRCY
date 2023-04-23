import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-add-gallery',
  templateUrl: './add-gallery.page.html',
  styleUrls: ['./add-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddGalleryPage implements OnInit {

  constructor(private router:Router, private menuController: MenuController) { }

  ngOnInit() {
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToGallery(){
    this.router.navigate(['/manage-gallery']);
  }
  
  closeMenu() {
    this.menuController.close();
  }

}
