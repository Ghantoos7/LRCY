import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class EventService {
  private base_url = 'http://localhost:8000/api/v0.1/event/';

  constructor(private http:HttpClient) { }

  get_events(){
    const response = this.http.get(this.base_url + 'get_event_info');
    return response;
  }

 
  get_event(id: string){
    const response = this.http.get(this.base_url + "get_event_info/" + id);
    return response;
  }

  get_event_pictures(id: string){
    const response = this.http.get(this.base_url + "get_event_pictures/" + id);
    return response;
  }

  getAnnouncements(){
    const response = this.http.get(this.base_url + 'get_announcements');
    return response;
  }
}
