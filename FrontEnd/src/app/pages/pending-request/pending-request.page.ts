import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-pending-request',
  templateUrl: './pending-request.page.html',
  styleUrls: ['./pending-request.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class PendingRequestPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
