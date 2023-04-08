import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];
  constructor() { 
    this.showDescriptions = new Array(3).fill(false);
  }

  ngOnInit() {

  }

  toggleDescription(index: number) {
    this.showDescriptions[index] = !this.showDescriptions[index];
  }
}
