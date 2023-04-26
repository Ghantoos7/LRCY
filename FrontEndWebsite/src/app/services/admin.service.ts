import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {

  constructor(private http:HttpClient) { }

  base_url = "http://localhost:8000/api/v0.1/admin/";
  base_url_event = "http://localhost:8000/api/v0.1/event/";
  base_url_user = "http://localhost:8000/api/v0.1/user/";

  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('authToken');
  
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });
  
    return headers;
  }

  getRequests(branch_id: string){
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + 'get_requests/' + branch_id, { headers: headers });
    return response;
  }

  acceptRequest(request_id: string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
      const options = { headers: headers };
    
      const body = {
        'request_id': request_id
      };
    
      const response = this.http.post(this.base_url + 'accept_request', body, options);
      return response;
  }

  declineRequest(request_id: string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
      const options = { headers: headers };
    
      const body = {
        'request_id': request_id
      };
    
      const response = this.http.post(this.base_url + 'decline_request', body, options);
      return response;
  }

  getAnnouncements(id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_event + 'get_announcements/' + id, { headers: headers });
    return response;
  }

  sendAnnouncement(title: string, content: string, importance_level: string, id: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'announcement_title': title,
      'announcement_content': content,
      'importance_level': importance_level,
      'admin_id': id
    };

    const response = this.http.post(this.base_url + 'send_announcement', body, options);
    return response;
  }

  deleteAnnouncement(announcement_id: string, admin_id: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'announcement_id': announcement_id,
      'admin_id': admin_id
    };

    const response = this.http.post(this.base_url + 'delete_announcement', body, options);
    return response;
  }

  editAnnouncement(announcement_id: string, admin_id: string, title: string, content: string, importance_level: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'announcement_id': announcement_id,
      'admin_id': admin_id,
      'announcement_title': title,
      'announcement_content': content,
      'importance_level': importance_level
    };

    const response = this.http.post(this.base_url + 'edit_announcement', body, options);
    return response;
  }

  getYearlyGoals(branch_id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_event + 'get_yearly_goals/' + branch_id , { headers: headers });
    return response;
  }

  deleteYearlyGoal(goal_id: string) {
    const headers = this.getAuthHeaders();
    const body = { goal_id: goal_id };
    const response = this.http.post(this.base_url + 'delete_yearly_goal', body, { headers: headers });
    return response;
}

  editYearlyGoal(goal_id : number, branch_id : number, goal_name : string, goal_description : string, number_completed: number, number_to_complete: number, program_id:number, event_type_id:number, goal_year : number, start_date:string, goal_deadline:string ){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'goal_id': goal_id,
      'branch_id': branch_id,
      'goal_name': goal_name,
      'goal_description': goal_description,
      'number_completed': number_completed,
      'number_to_complete': number_to_complete,
      'program_id': program_id,
      'event_type_id': event_type_id,
      'goal_year': goal_year,
      'start_date': start_date,
      'goal_deadline': goal_deadline
    };

    const response = this.http.post(this.base_url + 'edit_yearly_goal', body, options);
    return response;
  }

  setYearlyGoal(branch_id : number, goal_name : string, goal_description : string, number_to_complete: number, program_id:number, event_type_id:number, goal_year : number, start_date:string, goal_deadline:string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };
  
    const body = {
      'branch_id': branch_id,
      'goal_name': goal_name,
      'goal_description': goal_description,
      'number_to_complete': number_to_complete, 
      'program_id': program_id,
      'event_type_id': event_type_id,
      'goal_year': goal_year,
      'start_date': start_date,
      'goal_deadline': goal_deadline
    };
  
    const response = this.http.post(this.base_url + 'set_yearly_goal', body, options);
    return response;
  }

  getUserInfo(branch_id: string, user_id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_user + 'get_user_info/' + branch_id + '/' + user_id, { headers: headers });
    return response;
  }

  editUser(user_id:  string, first_name: string, last_name: string, is_active : number , user_start_date : string, user_end_date : string, user_position : string, user_type_id : number , gender: string, user_dob : string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'user_id': user_id,
      'first_name': first_name,
      'last_name': last_name,
      'is_active': is_active,
      'user_start_date': user_start_date,
      'user_end_date': user_end_date,
      'user_position': user_position,
      'user_type_id': user_type_id,
      'gender' : gender,
      'user_dob' : user_dob,
    };

    const response = this.http.post(this.base_url + 'edit_user', body, options);
    return response;
  }

  deleteUser(user_id: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const body = { user_id: user_id };
    const response = this.http.post(this.base_url + 'delete_user', body, { headers: headers });
    return response;
  }


  addUser(branch_id:number, first_name:string, last_name:string, organization_id : number, user_dob: string, user_position:string, gender:number, user_type_id : number, is_active: number, user_start_date: string, user_end_date:string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const body = {
      'branch_id': branch_id,
      'first_name': first_name,
      'last_name': last_name,
      'organization_id': organization_id,
      'user_dob': user_dob,
      'user_position': user_position,
      'gender' : gender,
      'user_type_id' : user_type_id,
      'is_active' : is_active,
      'user_start_date' : user_start_date,
      'user_end_date' : user_end_date

  }
    const response = this.http.post(this.base_url + 'add_user', body, { headers: headers });
    return response;
  }

  getEvents(branch_id: string, event_type_id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_event + 'get_event_info/' + branch_id + "/" + event_type_id,  { headers: headers });
    return response;
  }

  addEvent(branch_id : string, event_title : string, event_description : string, event_date : string, event_type_id : string, program_id : string, event_main_picture : string, event_location : string, budget_sheet : string, proposal : string, responsibles : [], meeting_minute? : string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'branch_id': branch_id,
      'event_title': event_title,
      'event_description': event_description,
      'event_date': event_date,
      'event_type_id': event_type_id,
      'program_id': program_id,
      'event_main_picture': event_main_picture,
      'event_location': event_location,
      'budget_sheet': budget_sheet,
      'proposal': proposal,
      'meeting_minute': meeting_minute,// can be null
      'responsibles': responsibles,

    };

    const response = this.http.post(this.base_url + 'add_event', body, options);
    return response;
  }

  editEvent(event_id : number, event_title : string, event_description : string, event_date : string, event_type_id : number, program_id : number, event_main_picture : string, event_location : string, budget_sheet : string, proposal : string, responsibles : any, meeting_minute? : string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'event_id': event_id,
      'event_title': event_title,
      'event_description': event_description,
      'event_date': event_date,
      'event_type_id': event_type_id,
      'program_id': program_id,
      'event_main_picture': event_main_picture,
      'event_location': event_location,
      'budget_sheet': budget_sheet,
      'proposal': proposal,
      'meeting_minute': meeting_minute,// can be null
      'responsibles': responsibles,
    
    };

    const response = this.http.post(this.base_url + 'edit_event', body, options);
    return response;

  }



  getTrainingInfo(training_id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_event + 'get_training_info/' + training_id, { headers: headers });
    return response;
  }


  addTrainingForUsers(training_ids : number [], user_ids : number []){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const body = {
      'training_ids': training_ids,
      'user_ids': user_ids
    }
    const response = this.http.post(this.base_url + 'add_training_for_user', body, { headers: headers });
    return response;
  }

  deleteTrainingForUsers(training_ids : number [], user_ids : number []){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const body = {
      'training_ids': training_ids,
      'user_ids': user_ids,
    }
    const response = this.http.post(this.base_url + 'delete_training_for_user', body, { headers: headers });
    return response;

  }

  logout() {
    const headers = this.getAuthHeaders();
    const response = this.http.post(this.base_url + 'logout', {}, { headers: headers });
  return response;
  }

  
  


}
