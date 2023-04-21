import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];

  constructor(private router:Router, private menuController: MenuController) { 
    this.showDescriptions = new Array(3).fill(false);
  }

  ngOnInit() {
  }

  toggleDescription(index: number) {
    this.showDescriptions[index] = !this.showDescriptions[index];
  }

  goToSendAnnouncement(){
    this.router.navigate(['/send-announcement']);
  }

  closeMenu() {
    this.menuController.close();
  }

}
