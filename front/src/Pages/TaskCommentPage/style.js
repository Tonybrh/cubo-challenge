import styled from 'styled-components';

export const CommentButton = styled.button`
    padding: 0.5rem 1rem;
    background: #9c27b0;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 0.5rem 0;
    width: 100%;

    &:hover {
        background: #7b1fa2;
    }
`;

export const BackButton = styled.button`
    padding: 0.5rem 1rem;
    background: #607d8b;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 1rem;
    width: 140px;

    &:hover {
        background: #455a64;
    }
`;

export const CommentsList = styled.div`
    margin: 1rem 0;
`;

export const CommentItem = styled.div`
    background: #f5f5f5;
    border-radius: 4px;
    margin-bottom: 1rem;
`;

export const CommentContent = styled.p`
    margin: 0 0 0.5rem 0;
`;

export const CommentMeta = styled.small`
    color: #666;
`;

export const CommentForm = styled.form`
    margin-top: 2rem;
`;

export const CommentTextArea = styled.textarea`
    width: 100%;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    min-height: 100px;
    font-family: inherit;
`;

export const AddCommentButton = styled.button`
    padding: 0.5rem 1rem;
    background: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;

    &:hover {
        background: #388e3c;
    }
`;

export const NoCommentsMessage = styled.div`
    text-align: center;
    margin: 2rem 0;
    display: flex;
    flex-direction: column;
    width: 20%;
`;

export const EditButton = styled.button`
    padding: 0.5rem 1rem;
    background: #1976d2;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;
    width: 100%;

    &:hover {
        background: #1565c0;
    }
`;

export const DeleteButton = styled.button`
    padding: 0.5rem 1rem;
    background: #d32f2f;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;
    width: 100%;

    &:hover {
        background: #b71c1c;
    }
`;

export const DashboardContainer = styled.div`
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    display: flex;
    flex-direction: column;
`;
