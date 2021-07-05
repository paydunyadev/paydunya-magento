import { IUser } from 'app/core/user/user.model';
import { IType } from 'app/shared/model/demande/type.model';

export interface IDemande {
  id?: number;
  lastName?: string;
  firstName?: string;
  imagePieceContentType?: string;
  imagePiece?: any;
  user?: IUser;
  type?: IType;
}

export class Demande implements IDemande {
  constructor(
    public id?: number,
    public lastName?: string,
    public firstName?: string,
    public imagePieceContentType?: string,
    public imagePiece?: any,
    public user?: IUser,
    public type?: IType
  ) {}
}
