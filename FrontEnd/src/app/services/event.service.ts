import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class EventService {
  private base_url = 'http://localhost:8000/api/v0.1/event/';

  constructor(private http:HttpClient) { }

  get_events(branch: string){
    const response = this.http.get(this.base_url + 'get_event_info/' + branch);
    return response;
  }

 
  get_event(branch: string,id: string){
    const response = this.http.get(this.base_url + "get_event_info/" + branch+"/" + id);
    return response;
  }

  get_event_pictures(id: string){
    const response = this.http.get(this.base_url + "get_event_pictures/" + id);
    return response;
  }

  getAnnouncements(id: string){
    const response = this.http.get(this.base_url + 'get_announcements/' + id);
    return response;
  }

  getYearlyGoals(id: string){
    const response = this.http.get(this.base_url + 'get_yearly_goals/' + id);
    return response;
  }
  
}
