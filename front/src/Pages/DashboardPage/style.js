import styled from 'styled-components';
import {TaskStatusEnum} from "../../Enum/taskEnum";

export const DashboardContainer = styled.div`
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    display: flex;
    flex-direction: column;
`;

export const Header = styled.header`
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
`;

export const CreateButton = styled.button`
    padding: 1rem 1rem;
    background: #2684FC;
    border: 0;
    color: white;
    border-radius: 8px;
    font-size: 1.2rem;
    cursor: pointer;
`

export const Title = styled.h1`
    color: #333;
`;

export const LogoutButton = styled.button`
    padding: 1rem 1rem;
    background: #d32f2f;
    border: 0;
    color: white;
    border-radius: 8px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: background 0.2s;
    margin-left: 10px;

    &:hover {
        background: #b71c1c;
    }
`;

export const TasksGrid = styled.div`
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-top: 2rem;

    @media (max-width: 900px) {
        grid-template-columns: repeat(2, 1fr);
    }

    @media (max-width: 600px) {
        grid-template-columns: 1fr;
    }
`;

export const TaskCard = styled.div`
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    &:hover {
        transform: translateY(-5px);
    }
`;

export const TaskTitle = styled.h3`
    margin-bottom: 0.5rem;
    color: #333;
`;

export const TaskDescription = styled.p`
    color: #666;
    margin-bottom: 1rem;
`;

export const TaskStatus = styled.span`
    padding: 0.25rem 0.5rem;
    background: ${props => TaskStatusEnum.getColor(props.task_status_id)};
    color: white;
    border-radius: 4px;
    font-size: 0.8rem;
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

export const FiltersContainer = styled.div`
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
`;

export const FilterLabel = styled.span`
    font-weight: 500;
    color: #333;
`;
export const FilterSelect = styled.select`
    padding: 0.5rem;
    border-radius: 4px;
    border: 1px solid #ddd;
    background: white;
`;

export const Input = styled.input`
    width: 100%;
    padding: 0.8rem;
    margin: 0.5rem 0 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
`;

export const TextArea = styled.textarea`
    width: 100%;
    padding: 0.8rem;
    margin: 0.5rem 0 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
    resize: vertical;
`;

export const Select = styled.select`
    width: 100%;
    padding: 0.8rem;
    margin: 0.5rem 0 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
`;
