import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-event-pictures',
  templateUrl: './event-pictures.page.html',
  styleUrls: ['./event-pictures.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EventPicturesPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
