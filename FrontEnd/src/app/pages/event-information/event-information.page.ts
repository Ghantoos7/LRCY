import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-event-information',
  templateUrl: './event-information.page.html',
  styleUrls: ['./event-information.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EventInformationPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
