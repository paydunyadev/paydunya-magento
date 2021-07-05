import { Moment } from 'moment';
import { ICommentaire } from 'app/shared/model/commentaire.model';
import { ITechno } from 'app/shared/model/techno.model';
import { ILangage } from 'app/shared/model/langage.model';

export interface IQuestion {
  id?: number;
  libelle?: string;
  date?: Moment;
  cloturer?: boolean;
  commentaires?: ICommentaire[];
  techno?: ITechno;
  langage?: ILangage;
}

export class Question implements IQuestion {
  constructor(
    public id?: number,
    public libelle?: string,
    public date?: Moment,
    public cloturer?: boolean,
    public commentaires?: ICommentaire[],
    public techno?: ITechno,
    public langage?: ILangage
  ) {
    this.cloturer = this.cloturer || false;
  }
}
