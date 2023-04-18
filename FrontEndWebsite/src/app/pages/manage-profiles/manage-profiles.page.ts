import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-manage-profiles',
  templateUrl: './manage-profiles.page.html',
  styleUrls: ['./manage-profiles.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class ManageProfilesPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
