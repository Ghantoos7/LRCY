import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-other-gallery',
  templateUrl: './other-gallery.page.html',
  styleUrls: ['./other-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class OtherGalleryPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
