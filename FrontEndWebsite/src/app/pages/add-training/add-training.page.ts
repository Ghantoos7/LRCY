import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-add-training',
  templateUrl: './add-training.page.html',
  styleUrls: ['./add-training.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddTrainingPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
