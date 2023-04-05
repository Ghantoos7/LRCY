import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-hvp-gallery',
  templateUrl: './hvp-gallery.page.html',
  styleUrls: ['./hvp-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class HvpGalleryPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
