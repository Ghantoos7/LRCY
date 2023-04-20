import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-send-announcement',
  templateUrl: './send-announcement.page.html',
  styleUrls: ['./send-announcement.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SendAnnouncementPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
