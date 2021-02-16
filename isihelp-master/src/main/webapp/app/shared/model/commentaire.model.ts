import { Moment } from 'moment';
import { IQuestion } from 'app/shared/model/question.model';

export interface ICommentaire {
  id?: number;
  libelle?: string;
  date?: Moment;
  vote?: number;
  question?: IQuestion;
}

export class Commentaire implements ICommentaire {
  constructor(public id?: number, public libelle?: string, public date?: Moment, public vote?: number, public question?: IQuestion) {}
}
