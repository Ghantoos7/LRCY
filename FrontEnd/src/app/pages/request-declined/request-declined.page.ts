import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-request-declined',
  templateUrl: './request-declined.page.html',
  styleUrls: ['./request-declined.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class RequestDeclinedPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
