import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';

@Component({
  selector: 'app-yearly-goals',
  templateUrl: './yearly-goals.page.html',
  styleUrls: ['./yearly-goals.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class YearlyGoalsPage implements OnInit {

  constructor(private router:Router) { }

  ngOnInit() {
  }

}
