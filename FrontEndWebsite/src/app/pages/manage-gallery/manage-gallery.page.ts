import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormControl, FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { MenuController } from '@ionic/angular';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';
import { ReactiveFormsModule } from '@angular/forms';
import { debounceTime } from 'rxjs/operators';


@Component({
  selector: 'app-manage-gallery',
  templateUrl: './manage-gallery.page.html',
  styleUrls: ['./manage-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule,ReactiveFormsModule]
})
export class ManageGalleryPage implements OnInit {

  branch_id = localStorage.getItem('branch_id') as string;
  events: any=[];
  yah_events: any=[];
  environment_events: any=[];
  hvp_events: any=[];
  other_events: any=[];

  searchControl: FormControl = new FormControl('');
  filtered_events: any = [];
  filtered_yah_events: any = [];
  filtered_environment_events: any = [];
  filtered_hvp_events: any = [];
  filtered_other_events: any = [];
  searchPerformed: boolean = false;

  constructor(private menuCtrl: MenuController, private router:Router, private menuController: MenuController, private service:AdminService) { }

  ngOnInit() {

    this.fetchEvents();

    this.router.events.subscribe((event) => {
      if (event instanceof NavigationEnd && event.url === '/manage-gallery') {
        this.fetchEvents();
      }
    });

    this.searchControl.valueChanges.pipe(debounceTime(300)).subscribe(() => {
      this.onSearchChange();
    });

  }

  onSearchChange() {
    const query = this.searchControl.value;
    this.searchPerformed = query.length > 0;
    this.filtered_events = this.filterEvents(query, this.events);
  }
  
  filterEvents(query: string, events: Record<string, any[]>) {
    // Convert the query to lowercase for case-insensitive search
    query = query.toLowerCase().trim();
  
    // Initialize the filtered events arrays
    this.filtered_yah_events = [];
    this.filtered_environment_events = [];
    this.filtered_hvp_events = [];
    this.filtered_other_events = [];
  
    // Iterate through the event categories
    for (const category in events) {
      // Iterate through the events in the current category
      events[category].forEach((event: any) => {
        // Check if the event title matches the query
        if (event.event_title.toLowerCase().includes(query)) {
          // Add the event to the corresponding filtered events array
          switch (category) {
            case 'Youth and Health':
              this.filtered_yah_events.push(event);
              break;
            case 'Environment':
              this.filtered_environment_events.push(event);
              break;
            case 'Human Values and Principles':
              this.filtered_hvp_events.push(event);
              break;
            case 'Others':
              this.filtered_other_events.push(event);
              break;
          }
        }
      });
    }
  }
  
  fetchEvents(){
    this.service.getEvents(this.branch_id,"").subscribe((response: any)=>{
      const parsedResponse = JSON.parse(JSON.stringify(response));
      this.events=parsedResponse['events'];
      this.yah_events=this.events['Youth and Health'];
      this.environment_events=this.events['Environment'];
      this.hvp_events=this.events['Human Values and Principles'];
      this.other_events=this.events['Others'];
      this.filtered_yah_events = this.yah_events;
      this.filtered_environment_events = this.environment_events;
      this.filtered_hvp_events = this.hvp_events;
      this.filtered_other_events = this.other_events;

      // Add console.log statements
    console.log('Fetched events:', this.events);
    console.log('Filtered events:', this.filtered_yah_events, this.filtered_environment_events, this.filtered_hvp_events, this.filtered_other_events);
    });
  }

  mapEventIcon(event_type_id: number) : string{
    if(event_type_id == 1){
      return "calendar-number-outline";
    }
    else if(event_type_id == 2){
      return "barbell-outline";
    }
    else{
      return "ellipsis-horizontal-outline";
    }
  }

  goToAddForm(){
    this.router.navigate(['/add-gallery'])
  }
  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuGallery');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuGallery');
  }

  goToHome(){
    this.service.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }

  goToEditGallery(event : any){
    this.router.navigate(['/edit-gallery'] ,{ state: { event: event } });
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  closeMenu() {
    this.menuController.close();
  }


}
