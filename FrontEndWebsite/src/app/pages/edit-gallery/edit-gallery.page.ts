import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';

@Component({
  selector: 'app-edit-gallery',
  templateUrl: './edit-gallery.page.html',
  styleUrls: ['./edit-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditGalleryPage implements OnInit {

  constructor(private router:Router) { }

  ngOnInit() {
  }

  goBack(){
    this.router.navigate(['/manage-gallery']);
  }

}
