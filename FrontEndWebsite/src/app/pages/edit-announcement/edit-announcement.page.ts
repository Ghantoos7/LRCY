import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';


@Component({
  selector: 'app-edit-announcement',
  templateUrl: './edit-announcement.page.html',
  styleUrls: ['./edit-announcement.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditAnnouncementPage implements OnInit {

  announcement: any;
  announcement_title: string="";
  announcement_content: string="";
  importance_level: string="";
  constructor(private router:Router,) { }

  ngOnInit() {
    const announcement = history.state.announcement;
    this.announcement = announcement;
  }

  goToAnnouncements(){
    this.router.navigate(['/announcements']);
  }

  goToSendAnnouncement(){
    this.router.navigate(['/send-announcement']);
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
