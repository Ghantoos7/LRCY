import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
@Component({
  selector: 'app-delete-training',
  templateUrl: './delete-training.page.html',
  styleUrls: ['./delete-training.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class DeleteTrainingPage implements OnInit {

  constructor(private router:Router) { }

  ngOnInit() {
  }

  goBack(){
    this.router.navigate(['/manage-profiles']);
  }

}
