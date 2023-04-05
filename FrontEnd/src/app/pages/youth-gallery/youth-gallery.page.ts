import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-youth-gallery',
  templateUrl: './youth-gallery.page.html',
  styleUrls: ['./youth-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class YouthGalleryPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
