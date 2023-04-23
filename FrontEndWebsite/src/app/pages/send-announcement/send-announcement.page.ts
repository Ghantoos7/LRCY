import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-send-announcement',
  templateUrl: './send-announcement.page.html',
  styleUrls: ['./send-announcement.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SendAnnouncementPage implements OnInit {

  constructor(private router:Router, private menuController: MenuController) { }

  ngOnInit() {
  }

  goToAnnouncements(){
    this.router.navigate(['/announcements']);
  }

  closeMenu() {
    this.menuController.close();
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
